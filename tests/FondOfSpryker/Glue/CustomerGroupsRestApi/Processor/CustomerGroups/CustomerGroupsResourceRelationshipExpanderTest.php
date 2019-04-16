<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerGroupsResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpander
     */
    protected $customerGroupsResourceRelationshipExpander;

    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupsMapperMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerGroupsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerGroupsAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerGroupCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerGroupTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $restResourceMocks;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getCustomerGroupCollection'])
            ->getMock();

        $this->customerGroupCollectionTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerGroupCollectionTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getGroups'])
            ->getMock();

        $this->customerGroupTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerGroupTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getUuid'])
            ->getMock();

        $this->restCustomerGroupsAttributesTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\RestCustomerGroupsAttributesTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupsMapperMock = $this->getMockBuilder(CustomerGroupsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMocks = [
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupsResourceRelationshipExpander = new CustomerGroupsResourceRelationshipExpander(
            $this->restResourceBuilderMock,
            $this->customerGroupsMapperMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsWithoutPayloads(): void
    {
        $this->restResourceMocks[0]->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn(null);

        $this->restResourceMocks[0]->expects($this->never())
            ->method('addRelationship');

        $restResources = $this->customerGroupsResourceRelationshipExpander->addResourceRelationships(
            $this->restResourceMocks,
            $this->restRequestMock
        );

        $this->assertEquals($this->restResourceMocks, $restResources);
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsWithPayloadAndNoCustomerGroups(): void
    {
        $this->restResourceMocks[0]->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerGroupCollection')
            ->willReturn(null);

        $this->restResourceMocks[0]->expects($this->never())
            ->method('addRelationship');

        $restResources = $this->customerGroupsResourceRelationshipExpander->addResourceRelationships(
            $this->restResourceMocks,
            $this->restRequestMock
        );

        $this->assertEquals($this->restResourceMocks, $restResources);
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $uuid = '12345-12345-12345-12345';

        $this->restResourceMocks[0]->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerGroupCollection')
            ->willReturn($this->customerGroupCollectionTransferMock);

        $this->customerGroupCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getGroups')
            ->willReturn([$this->customerGroupTransferMock]);

        $this->customerGroupsMapperMock->expects($this->atLeastOnce())
            ->method('mapRestCustomerGroupsAttributesTransfer')
            ->with($this->customerGroupTransferMock)
            ->willReturn($this->restCustomerGroupsAttributesTransferMock);

        $this->customerGroupTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                CustomerGroupsRestApiConfig::RESOURCE_CUSTOMER_GROUPS,
                $uuid,
                $this->restCustomerGroupsAttributesTransferMock
            )
            ->willReturn($this->restResourceMock);

        $this->restResourceMocks[0]->expects($this->atLeastOnce())
            ->method('addRelationship')
            ->with($this->restResourceMock);

        $restResources = $this->customerGroupsResourceRelationshipExpander->addResourceRelationships(
            $this->restResourceMocks,
            $this->restRequestMock
        );

        $this->assertEquals($this->restResourceMocks, $restResources);
    }
}
