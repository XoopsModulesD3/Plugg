<?php
class Plugg_System_Model_RoutesWithDescendantsCount extends Sabai_Model_EntityCollection_Decorator_DescendantEntitiesCount
{
    public function __construct(Sabai_Model_EntityCollection $collection)
    {
        parent::__construct('Route', $collection);
    }
}