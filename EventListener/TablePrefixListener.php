<?php
/**
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 */

namespace phpBB\SessionsAuthBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use phpBB\SessionsAuthBundle\Entity as Entity;

/**
 * The table prefix for the users table is defined within the configuration for this bundle.
 * This listener makes sure the table name is.
 */
class TablePrefixListener
{
    /** @var array Entity that will receive the prefix */
    private const ENTITY_NAME = [
        Entity::class.'\User',
        Entity::class.'\UserGroup',
        Entity::class.'\Session',
        Entity::class.'\SessionKey',
    ];

    public function __construct(private string $prefix) {}

    public function __invoke(LoadClassMetadataEventArgs $args): void
    {
        $classMetadata = $args->getClassMetadata();
        if (Entity::class == $classMetadata->namespace && in_array($classMetadata->name, self::ENTITY_NAME)) {
            if (!$classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName() === $classMetadata->rootEntityName) {
                $classMetadata->setPrimaryTable(['name' => $this->prefix.$classMetadata->getTableName()]);
            }
            foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
                if (ClassMetadataInfo::MANY_TO_MANY == $mapping['type'] && true == $mapping['isOwningSide']) {
                    $mappedTableName = $mapping['joinTable']['name'];
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix.$mappedTableName;
                }
            }
        }
    }
}
