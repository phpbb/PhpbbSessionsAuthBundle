<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpbb\SessionAuthBundle\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;


/**
 * The table prefix for the users table is defined within the configuration for this bundle.
 * This Subscriber makes sure the table name is
 * @package phpbb\SessionAuthBundle\Subscriber
 */
class TablePrefixSubscriber implements EventSubscriber{

    /**
     * Namespace the entity is in
     */
    const ENTITY_NAMESPACE = 'phpbb\\SessionAuthBundle\\Entity';
    /**
     * Entity that will receive the prefix
     */
    const ENTITY_NAME = 'User';

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * Constructor
     *
     * @param string $prefix
     */
    public function __construct($prefix)
    {
        $this->prefix = (string) $prefix;
    }

    /**
     * Get subscribed events
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array('loadClassMetadata');
    }

    /**
     * Load class meta data event
     *
     * @param LoadClassMetadataEventArgs $args
     *
     * @return void
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $classMetadata = $args->getClassMetadata();

        if (empty($this->prefix)) {
            // Prefix is empty, we don't need to do anything;
            return;
        }

        if ($classMetadata->namespace == self::ENTITY_NAMESPACE && $classMetadata->name == self::ENTITY_NAME) {
            // Do not re-apply the prefix when the table is already prefixed
            if (false === strpos($classMetadata->getTableName(), $this->prefix)) {
                $tableName = $this->prefix . $classMetadata->getTableName();
                $classMetadata->setPrimaryTable(['name' => $tableName]);
            }

            foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
                if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide'] == true) {
                    $mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];

                    // Do not re-apply the prefix when the association is already prefixed
                    if (false !== strpos($mappedTableName, $this->prefix)) {
                        continue;
                    }

                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix . $mappedTableName;
                }
            }
        }
    }
}