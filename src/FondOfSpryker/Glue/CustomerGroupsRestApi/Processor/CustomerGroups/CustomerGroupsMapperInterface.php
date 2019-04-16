<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use Generated\Shared\Transfer\CustomerGroupTransfer;
use Generated\Shared\Transfer\RestCustomerGroupsAttributesTransfer;

interface CustomerGroupsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerGroupTransfer $customerGroupTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerGroupsAttributesTransfer
     */
    public function mapRestCustomerGroupsAttributesTransfer(
        CustomerGroupTransfer $customerGroupTransfer
    ): RestCustomerGroupsAttributesTransfer;
}
