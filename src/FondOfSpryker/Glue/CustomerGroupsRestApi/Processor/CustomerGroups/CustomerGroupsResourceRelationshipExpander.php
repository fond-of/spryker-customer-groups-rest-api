<?php

namespace FondOfSpryker\Glue\CustomerGroupsRestApi\Processor\CustomerGroups;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerGroupsResourceRelationshipExpander implements CustomerGroupsResourceRelationshipExpanderInterface
{
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

            $payload->getC

            $brandRelationTransfer = $companyTransfer->getBrandRelation();

            if ($brandRelationTransfer === null) {
                continue;
            }

            foreach ($brandRelationTransfer->getBrands() as $brandTransfer) {
                $restBrandsResponseAttributesTransfer = $this->brandsMapper
                    ->mapRestBrandsResponseAttributesTransfer($brandTransfer);

                $brandResource = $this->restResourceBuilder->createRestResource(
                    BrandsRestApiConfig::RESOURCE_BRANDS,
                    $brandTransfer->getUuid(),
                    $restBrandsResponseAttributesTransfer
                );

                $resource->addRelationship($brandResource);
            }
        }

        return $resources;
    }
}
