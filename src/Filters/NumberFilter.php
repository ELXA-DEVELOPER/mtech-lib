<?php

namespace MtLib\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class NumberFilter implements Filter
{
    protected $query;
    protected $property;
    protected $operator;
    protected $value1;
    protected $value2;

    public function __invoke(Builder $query, mixed $values, string $property): void
    {
        $this->query = $query;
        $this->property = $property;
        $this->operator = $values[0] ?? null;
        $this->value1 = $values[1] ?? null;
        $this->value2 = $values[2] ?? null;

        abort_if(
            is_string($values) || blank($this->operator) || blank($this->value1),
            422, "Filter parameters for $property is incorrect."
        );

        $this->buildQuery();
    }

    private function buildQuery() : void
    {
        switch ($this->operator)
        {
            case 'is':
                $queryMethod = 'where' . Str::studly($this->value1);
                if (in_array($queryMethod, ['whereNull', 'whereNotNull'])) {
                    $this->query->{$queryMethod}($this->property);
                }
                break;

            case 'between':
                $this->query->whereBetween($this->property, [$this->value1, $this->value2]);
                break;

            default:
                $this->query->whereRaw(
                    sprintf('%s %s ?', $this->property, $this->opTranslate($this->operator)),
                    $this->value1
                );
                break;
        }
    }

    private function opTranslate($strOperator)
    {
        switch ($strOperator) {
            case 'gt': return '>';
            case 'gte': return '>=';
            case 'lt': return '<';
            case 'lte': return '<=';
            case 'eq': return '=';
            case 'like': return 'LIKE';
            case 'between': return 'BETWEEN';
            default: return $strOperator;
        }
    }
}

