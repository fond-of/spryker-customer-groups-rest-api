<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiConfig;
use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiFactory;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerGroupsCustomersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Plugin\CustomerGroupsCustomersResourceRelationshipPlugin|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupsCustomersResourceRelationshipPlugin;

    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupsRestApiFactoryMock;

    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupsResourceRelationshipExpanderMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface[]|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourcesMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupsRestApiFactoryMock = $this->getMockBuilder(CustomerGroupsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupsResourceRelationshipExpanderMock = $this->getMockBuilder(CustomerGroupsResourceRelationshipExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourcesMock = [
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupsCustomersResourceRelationshipPlugin = $this->getMockBuilder(CustomerGroupsCustomersResourceRelationshipPlugin::class)
            ->setMethods(['getFactory'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->customerGroupsCustomersResourceRelationshipPlugin->expects($this->atLeastOnce())
            ->method('getFactory')
            ->willReturn($this->customerGroupsRestApiFactoryMock);

        $this->customerGroupsRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerGroupsResourceRelationshipExpander')
            ->willReturn($this->customerGroupsResourceRelationshipExpanderMock);

        $this->customerGroupsResourceRelationshipExpanderMock->expects($this->atLeastOnce())
            ->method('addResourceRelationships')
            ->with($this->restResourcesMock, $this->restRequestMock)
            ->willReturn($this->restResourcesMock);

        $this->customerGroupsCustomersResourceRelationshipPlugin->addResourceRelationships(
            $this->restResourcesMock,
            $this->restRequestMock
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        $relationshipResourceType = $this->customerGroupsCustomersResourceRelationshipPlugin->getRelationshipResourceType();

        $this->assertEquals(
            CustomerGroupsRestApiConfig::RESOURCE_CUSTOMER_GROUPS,
            $relationshipResourceType
        );
    }
}
