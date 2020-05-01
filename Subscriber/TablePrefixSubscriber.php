<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;


/**
 * The table prefix for the users table is defined within the configuration for this bundle.
 * This Subscriber makes sure the table name is
 * @package phpbb\SessionsAuthBundle\Subscriber
 */
class TablePrefixSubscriber implements EventSubscriber
{

    /**
     * Namespace the entity is in
     */
    private static $ENTITY_NAMESPACE = 'phpBB\\SessionsAuthBundle\\Entity';
    /**
     * Entity that will receive the prefix
     */
    private static $ENTITY_NAME;

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
        self::$ENTITY_NAME = [
            self::$ENTITY_NAMESPACE.'\\User',
            self::$ENTITY_NAMESPACE.'\\UserGroup',
            self::$ENTITY_NAMESPACE.'\\Session',
            self::$ENTITY_NAMESPACE.'\\SessionKey'
        ];
    }

    /**
     * Get subscribed events
     *
     * @return string[]
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
        /** @var ClassMetadata $classMetadata */
        $classMetadata = $args->getClassMetadata();

        if (empty($this->prefix))
        {
            // Prefix is empty, we don't need to do anything;
            return;
        }

        if ($classMetadata->namespace == self::$ENTITY_NAMESPACE && in_array($classMetadata->name, self::$ENTITY_NAME))
        {
            // Do not re-apply the prefix when the table is already prefixed
            if (false === strpos($classMetadata->getTableName(), $this->prefix))
            {
                $tableName = $this->prefix . $classMetadata->getTableName();
                $classMetadata->setPrimaryTable(array('name' => $tableName));
            }

            foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping)
            {
                if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide'] == true)
                {
                    $mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];

                    // Do not re-apply the prefix when the association is already prefixed
                    if (false !== strpos($mappedTableName, $this->prefix))
                    {
                        continue;
                    }

                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix . $mappedTableName;
                }
            }
        }
    }
}
