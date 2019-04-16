<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use Codeception\Test\Unit;

class CustomerGroupsResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpander
     */
    protected $customerGroupsResourceRelationshipExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupsResourceRelationshipExpander = new CustomerGroupsResourceRelationshipExpander();
    }

    /**
     * @return void
     */
    public function testA(): void
    {
    }
}
