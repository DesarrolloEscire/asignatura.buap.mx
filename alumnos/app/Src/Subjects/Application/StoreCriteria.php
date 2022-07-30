<?php

namespace App\Src\Subjects\Application;

use App\Models\Criteria;
use App\Models\Subject;
use App\Src\Subjects\Domain\CriteriaPercentageExcedeed;
use App\Src\Subjects\Domain\MissingCriteriaPercentage;
use Illuminate\Support\Collection;

class StoreCriteria
{
    public function handle(array $criteria, Subject $subject)
    {
        $criteria = $this->removeCriteriaWithoutDescription($criteria);
        $this->validateCriteria($criteria);
        $this->createNewCriteria($criteria);
        $this->attachCriteria($subject, $criteria);
        $this->detachOldCriteria($subject, $criteria);
    }

    private function validateCriteria(Collection $criteria)
    {
        if ($criteria->pluck('percentage')->sum() > 100) {
            throw new CriteriaPercentageExcedeed;
        }

        if ($criteria->pluck('percentage')->sum() < 100) {
            throw new MissingCriteriaPercentage;
        }
    }

    private function removeCriteriaWithoutDescription(array $criteria): Collection
    {
        return collect($criteria)->filter(function (array $criterion) {
            return array_key_exists('description', $criterion)
                && !empty($criterion["description"])
                && !is_null($criterion["description"]);
        });
    }

    private function createNewCriteria(Collection $criteria)
    {
        $criteria->map(function ($criterion) {
            Criteria::firstOrCreate([
                'description' => $criterion["description"]
            ]);
        });
    }

    private function attachCriteria(Subject $subject, Collection $criteria)
    {
        $criteria->map(function ($criterion) use ($subject) {
            $subject
                ->syncCriteriaWithoutDetaching(
                    Criteria::where('description', $criterion["description"])->first(),
                    ['percentage' => $criterion['percentage']]
                );
        });
    }

    private function detachOldCriteria(Subject $subject, Collection $criteria)
    {
        $criteriaToDetach = $subject
            ->criteria()
            ->whereNotIn('description', $criteria->pluck('description')->toArray())
            ->get();

        $subject->criteria()->detach($criteriaToDetach->pluck('id'));
    }
}
