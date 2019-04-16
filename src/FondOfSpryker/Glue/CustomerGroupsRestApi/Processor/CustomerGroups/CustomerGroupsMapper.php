<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use Generated\Shared\Transfer\CustomerGroupTransfer;
use Generated\Shared\Transfer\RestCustomerGroupsAttributesTransfer;

class CustomerGroupsMapper implements CustomerGroupsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerGroupTransfer $customerGroupTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerGroupsAttributesTransfer
     */
    public function mapRestCustomerGroupsAttributesTransfer(
        CustomerGroupTransfer $customerGroupTransfer
    ): RestCustomerGroupsAttributesTransfer {
        $restCustomerGroupsAttributesTransfer = new RestCustomerGroupsAttributesTransfer();

        $restCustomerGroupsAttributesTransfer->fromArray(
            $customerGroupTransfer->toArray(),
            true
        );

        return $restCustomerGroupsAttributesTransfer;
    }
}
