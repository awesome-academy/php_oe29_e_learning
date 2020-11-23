<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertHasMany($related, $foreignKey, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($foreignKey, $relation->getForeignKeyName());
    }

    protected function assertBelongsTo($related, $foreignKey, $ownerKey, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($ownerKey, $relation->getOwnerKeyName());
        $this->assertEquals($foreignKey, $relation->getForeignKeyName());
    }

    protected function assertBelongsToMany($related, $foreignPivotKey, $relatedPivotKey, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($foreignPivotKey, $relation->getForeignPivotKeyName());
        $this->assertEquals($relatedPivotKey, $relation->getRelatedPivotKeyName());
    }

    protected function assertMorphTo($related, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(MorphTo::class, $relation);
    }

    protected function assertMorphOne($related, $prefixKeyName, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(MorphOne::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($prefixKeyName . '_type', $relation->getMorphType());
        $this->assertEquals($prefixKeyName . '_id', $relation->getForeignKeyName());
    }

    protected function assertMorphMany($related, $prefixKeyName, $model, $relationName)
    {
        $relation = $model->$relationName();
        $this->assertInstanceOf(MorphMany::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($prefixKeyName . '_type', $relation->getMorphType());
        $this->assertEquals($prefixKeyName . '_id', $relation->getForeignKeyName());
    }

    protected function assertFillableProperties($attributes = [], $model)
    {
        $this->assertEquals($attributes, $model->getFillable());
    }
    
    protected function assertCastsProperties($attributes = [], $model)
    {
        $this->assertEquals($attributes, $model->getCasts());
    }

    protected function assertHiddenProperties($attributes = [], $model)
    {
        $this->assertEquals($attributes, $model->getHidden());
    }
}
