<?php
/**
 * An abstract fixture that will update or replace the data in an entity. This class
 * will simplify fixtures when using them to set default database values such as status's
 * or other pre-set application values. Remember to run fixutres with --append or all data
 * will be purged anyway!
 *
 * Create by Layton Everson <layton.everson@gmail.com>
 */

namespace App\DataFixtures;

use function array_keys;
use function call_user_func;
use function is_callable;
use function ucfirst;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractUpdateableFixture extends Fixture
{
    /**
     * @return array Return an array of Key=>Value arrays. the keys for each row should match the
     *            names of the columns.
     */
    abstract protected function getFixtureData();

    /**
     * Fully Qualified Namespace to the entity were loading
     *
     * @return  string
     */
    abstract protected function getEntityFqn();

    /**
     * Return `true` to delete the entities that are not included in the your fixture array data.
     *
     * @return  bool
     */
    abstract protected function getDeleteAbsentEntities();

    /**
     * @var EntityRepository
     */
    protected $myRepository;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $entityFqn = $this->getEntityFqn();
        $fixtureData = $this->getFixtureData();
        $connection = $manager->getConnection();
        $this->myRepository = $manager->getRepository($entityFqn);

        if ('' == $entityFqn || 0 === count($fixtureData)) {
            throw new \LogicException(
                "You need to override the \$fixtureData and \$entityFqn variable in your DataFixture class"
            );
        }

        $connection->beginTransaction();
        try {
            $newData = [];
            $connection->query('SET FOREIGN_KEY_CHECKS=0');

            foreach ($fixtureData as $record) {
                $columns = array_keys($record);
                $entity = null;
                if (isset($record['id'])) {
                    $entity = $this->myRepository->find($record['id']);
                }

                if (null === $entity) {
                    $entity = new $entityFqn();
                }

                foreach ($columns as $column) {

                    if (!is_callable($callable = [$entity, "set".ucfirst($column)])) {
                        throw new \RuntimeException("the $column column is not a valid setter on the entity.");
                    }

                    call_user_func($callable, $record[$column]);
                }

                $newData[] = $entity;
            }

            $tableName = $manager->getClassMetadata($entityFqn)->getTableName();
            if ($this->getDeleteAbsentEntities()) {
                $connection->query('DELETE FROM '.$tableName);
            }

            foreach ($newData as $rec) {
               $manager->persist($rec);
            }

            $manager->flush();

            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollback();
            throw new \RuntimeException(
                "Unable to import fixtures. Failed while updating database!"
                ." Exception in ".$e->getFile().": ".$e->getLine()
                ." \n\n".$e->getMessage()
                ." \n\n".$e->getTraceAsString()
            );
        }
    }
}
