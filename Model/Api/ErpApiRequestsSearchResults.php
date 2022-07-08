<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Api;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with ERP API Calls search results.
 */
class ErpApiRequestsSearchResults extends SearchResults implements ErpApiRequestsSearchResultsInterface
{
}
