<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use FondOfSpryker\Glue\CustomerGroupsRestApi\CustomerGroupsRestApiConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerGroupsResourceRelationshipExpander implements CustomerGroupsResourceRelationshipExpanderInterface
{
    /**
     * @var \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsMapperInterface
     */
    protected $customerGroupsMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups\CustomerGroupsMapperInterface $customerGroupsMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CustomerGroupsMapperInterface $customerGroupsMapper
    ) {
        $this->customerGroupsMapper = $customerGroupsMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array
    {
        foreach ($resources as $resource) {
            /**
             * @var \Generated\Shared\Transfer\CustomerTransfer|null $payload
             */
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CustomerTransfer)) {
                continue;
            }

            $customerGroupCollectionTransfer = $payload->getCustomerGroupCollection();

            if ($customerGroupCollectionTransfer === null) {
                continue;
            }

            foreach ($customerGroupCollectionTransfer->getGroups() as $customerGroupTransfer) {
                $restCustomerGroupsAttributesTransfer = $this->customerGroupsMapper
                    ->mapRestCustomerGroupsAttributesTransfer($customerGroupTransfer);

                $customerGroupsResource = $this->restResourceBuilder->createRestResource(
                    CustomerGroupsRestApiConfig::RESOURCE_CUSTOMER_GROUPS,
                    $customerGroupTransfer->getUuid(),
                    $restCustomerGroupsAttributesTransfer
                );

                $resource->addRelationship($customerGroupsResource);
            }
        }

        return $resources;
    }
}
