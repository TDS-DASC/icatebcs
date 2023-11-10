<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class StudentFilter extends Filter
{
    /**
     * Filter students by the given academic level.
     *
     * @param  string|null  $level
     * @return Builder
     */
    public function academic_level(string $level = null): Builder
    {
        return $this->builder->where('academic_level', $level);
    }

    /**
     * Filter students by the given job condition.
     *
     * @param  string|null  $condition
     * @return Builder
     */
    public function job_condition(string $condition = null): Builder
    {
        return $this->builder->where('job_condition', $condition);
    }

    /**
     * Filter students by the given center id.
     *
     * @param  string|null  $id
     * @return Builder
     */
    public function center(string $id = null): Builder
    {
        return $this->builder->with('center')
            ->where('center_id', $id);
    }

    /**
     * Filter students by the given city id.
     *
     * @param  string|null  $id
     * @return Builder
     */
    public function city(string $id = null): Builder
    {
        return $this->builder->whereHas('address', function ($query) use ($id) {
            $query->where('city_id', $id);
        });
    }
}
