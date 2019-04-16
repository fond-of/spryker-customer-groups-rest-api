<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi;

use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpander;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpanderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CustomerGroupsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpanderInterface
     */
    public function createCustomerGroupsResourceRelationshipExpander(): CustomerGroupsResourceRelationshipExpanderInterface
    {
        return new CustomerGroupsResourceRelationshipExpander();
    }
}
