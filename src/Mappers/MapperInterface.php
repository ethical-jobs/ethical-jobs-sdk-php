<?php

namespace EthicalJobs\SDK\Mappers;

/**
 * Mapper interface
 * \
 * @author Sebastian Sibelle <sebastian@ethicaljobs.com.au>
 */

interface MapperInterface
{
    /**
     * Maps the data
     *
     * @param $taxonomyId
     * @param $type
     * @return string
     */
    public function map(int $taxonomyId, string $type): string;
}
