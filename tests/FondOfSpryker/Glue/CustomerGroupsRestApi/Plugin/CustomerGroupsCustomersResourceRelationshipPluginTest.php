<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiConfig;
use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiFactory;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpanderInterface;
use ReflectionClass;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerGroupsCustomersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Plugin\CustomerGroupsCustomersResourceRelationshipPlugin
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
     * @throws
     *
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

        $this->customerGroupsCustomersResourceRelationshipPlugin = new CustomerGroupsCustomersResourceRelationshipPlugin();

        $this->addFactoryOverReflection();
    }

    /**
     * @throws
     *
     * @return void
     */
    protected function addFactoryOverReflection(): void
    {
        $reflection = new ReflectionClass(get_class($this->customerGroupsCustomersResourceRelationshipPlugin));

        $property = $reflection->getParentClass()->getProperty('factory');
        $property->setAccessible(true);
        $property->setValue(
            $this->customerGroupsCustomersResourceRelationshipPlugin,
            $this->customerGroupsRestApiFactoryMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
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
