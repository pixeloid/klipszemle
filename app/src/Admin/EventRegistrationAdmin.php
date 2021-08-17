<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\CoreBundle\Form\Type\DateTimePickerType;


use App\Entity\BudgetCategory;
class EventRegistrationAdmin extends AbstractAdmin
{

    public function createQuery($context = 'list')
    {

        $query = parent::createQuery($context);

        $query->andWhere($query->getRootAliases()[0] . '.created > :created');

        $query->setParameter('created', '2019-08-16');
        return $query;
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('categories')
            ->add('shortlist')
            ->add('onshow')
            ->add('premiere')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('author', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('songtitle', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('video_url', null, array(
                'template' => 'Admin/CRUD/list_youtube.html.twig',
                'header_style' => 'width: 120px',
            ))
            ->add('moviecategories', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('director', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('description', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('extra_info', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('premiere', null, [
                "editable" => true,
            ])
            ->add('onshow', null, [
                "editable" => true,
            ])
            ->add('shortlist', null, [
                "editable" => true,
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('shortlist')
            ->add('name')
            ->add('video_url')
            ->add('moviecategories', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false,
                ),
                array(
                       'edit' => 'inline',
                       'sortable' => 'position',
                        'inline' => 'table',
                  )
            )
            ->add('keywords', 'sonata_type_model', array(
                'property' => "name",
                'multiple' => true,
            ))
            ->add('producer')
            ->add('director')
            ->add('photographer')
            ->add('designer')
            ->add('editor')

            ->add('company')
            ->add('website')
            ->add('address')
            ->add('phone')
            ->add('author')
            ->add('songtitle')
            ->add('length')
            ->add('publisher')
            ->add('song_publish_date', null,[
                'required' => false
            ])
            ->add('video_publish_date')
            ->add('description')
            ->add('extra_info')
            ->add('budget_category')
            ->add('description')
            ->add('email')
            ->add('created', null, [
                'data' => new \DateTime
            ])
            ->add('winner')
            ->add('onshow')
            ->add('premiere')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('number')
            ->add('name')
            ->add('title')
            ->add('company')
            ->add('website')
            ->add('address')
            ->add('phone')
            ->add('author')
            ->add('songtitle')
            ->add('length')
            ->add('publisher')
            ->add('song_publish_date')
            ->add('video_publish_date')
            ->add('producer')
            ->add('director')
            ->add('photographer')
            ->add('designer')
            ->add('editor')
            ->add('technology')
            ->add('categories')
            ->add('budget')
            ->add('description')
            ->add('video_url')
            ->add('email')
            ->add('created')
            ->add('have_rights')
            ->add('winner')
            ->add('post_image')
            ->add('accept_terms')
            ->add('shortlist')
            ->add('onshow')
            ->add('premiere')
        ;
    }

    protected $perPageOptions = array(1000, 500, 100);
    
    protected $maxPerPage = 100;


    public function prePersist($object)
    {
        $object->setKeywords(array());
        foreach ($object->getKeywords() as $keyword) {
            $keyword->addEventRegistration($object);
        }
    }

    public function preUpdate($object)
    {
        $object->setKeywords(array());

        foreach ($object->getKeywords() as $keyword) {
            $keyword->addEventRegistration($object);
        }
    }


}
