<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpander;

class CustomerGroupsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiFactory
     */
    protected $customerGroupsRestApiFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupsRestApiFactory = new CustomerGroupsRestApiFactory();
    }

    /**
     * @return void
     */
    public function testCreateCustomerGroupsResourceRelationshipExpander(): void
    {
        $customerGroupsResourceRelationshipExpander = $this->customerGroupsRestApiFactory
            ->createCustomerGroupsResourceRelationshipExpander();

        $this->assertInstanceOf(
            CustomerGroupsResourceRelationshipExpander::class,
            $customerGroupsResourceRelationshipExpander
        );
    }
}
