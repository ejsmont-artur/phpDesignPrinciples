<?php

namespace PhpDesignPrinciples\Patterns\Service;

/**
 * Responsible for loading assets from "SOMEWHERE".
 * 
 * NOTE: Interface does not care from where nor how are they loaded.
 * NOTE: This is the highest level interface in this example.
 */
interface AssetServiceClientInterface {

    /**
     * Loads asset from "somewhere"
     * 
     * @param int $threadId
     * @throws Exception on any errors or if asset does not exist
     * @return PhpDesignPrinciples\Patterns\Service\Dto\AssetDto
     */
    public function getAsset($threadId);

    /**
     * This interface could have some more methods maybe to search for a list of assets etc.
     */
}