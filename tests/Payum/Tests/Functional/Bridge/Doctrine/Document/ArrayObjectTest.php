<?php
namespace Payum\Tests\Functional\Bridge\Doctrine\Document;

use Payum\Tests\Functional\Bridge\Doctrine\MongoTest;
use Payum\Examples\Document\ArrayObject;

class ArrayObjectTest extends MongoTest
{
    /**
     * @test
     */
    public function shouldAllowPersistEmpty()
    {
        $this->dm->persist(new ArrayObject);
        $this->dm->flush();
    }

    /**
     * @test
     */
    public function shouldAllowPersistWithSomeFieldsSet()
    {
        $model = new ArrayObject;
        $model['foo'] = 'theFoo';
        $model['bar'] = array('bar1', 'bar2' => 'theBar2');

        $this->dm->persist($model);
        $this->dm->flush();
    }

    /**
     * @test
     */
    public function shouldAllowFindPersistedArrayobject()
    {
        $model = new ArrayObject;
        $model['foo'] = 'theFoo';
        $model['bar'] = array('bar1', 'bar2' => 'theBar2');

        $this->dm->persist($model);
        $this->dm->flush();
        
        $id = $model->getId();

        $this->dm->clear();
        
        $foundModel = $this->dm->find(get_class($model), $id);

        //guard
        $this->assertNotSame($model, $foundModel);
        
        $this->assertEquals(iterator_to_array($model), iterator_to_array($foundModel));
    }
}