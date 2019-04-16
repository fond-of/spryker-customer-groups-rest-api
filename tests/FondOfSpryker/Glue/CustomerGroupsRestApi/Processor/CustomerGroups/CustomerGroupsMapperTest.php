<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use Codeception\Test\Unit;

class CustomerGroupsMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsMapper
     */
    protected $customerGroupsMapper;

    /**
     * @var \Generated\Shared\Transfer\CustomerGroupTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerGroupTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['toArray'])
            ->getMock();

        $this->customerGroupsMapper = new CustomerGroupsMapper();
    }

    /**
     * @return void
     */
    public function testMapRestCustomerGroupsAttributesTransfer(): void
    {
        $this->customerGroupTransferMock->expects($this->atLeastOnce)
            ->method('toArray')
            ->willReturn([]);

        $this->customerGroupsMapper->mapRestCustomerGroupsAttributesTransfer();
    }
}
