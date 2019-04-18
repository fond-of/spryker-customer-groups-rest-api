<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsMapper;
use FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsResourceRelationshipExpander;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class CustomerGroupsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupsRestApiFactory;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupsRestApiFactory = $this->getMockBuilder(CustomerGroupsRestApiFactory::class)
            ->setMethods(['getResourceBuilder'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testCreateCustomerGroupsResourceRelationshipExpander(): void
    {
        $this->customerGroupsRestApiFactory->expects($this->atLeastOnce())
            ->method('getResourceBuilder')
            ->willReturn($this->resourceBuilderMock);

        $customerGroupsResourceRelationshipExpander = $this->customerGroupsRestApiFactory
            ->createCustomerGroupsResourceRelationshipExpander();

        $this->assertInstanceOf(
            CustomerGroupsResourceRelationshipExpander::class,
            $customerGroupsResourceRelationshipExpander
        );
    }

    /**
     * @return void
     */
    public function testCreateCustomerGroupsMapper(): void
    {
        $customerGroupsMapper = $this->customerGroupsRestApiFactory
            ->createCustomerGroupsMapper();

        $this->assertInstanceOf(
            CustomerGroupsMapper::class,
            $customerGroupsMapper
        );
    }
}
