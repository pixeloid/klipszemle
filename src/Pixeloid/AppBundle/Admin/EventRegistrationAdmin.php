<?php

namespace Pixeloid\AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\CoreBundle\Form\Type\DateTimePickerType;


use Pixeloid\AppBundle\Entity\BudgetCategory;
class EventRegistrationAdmin extends AbstractAdmin
{

    public function createQuery($context = 'list')
    {

        $query = parent::createQuery($context);

        $query->andWhere($query->getRootAliases()[0] . '.created > :created');

        $query->setParameter('created', '2018-07-01');
        return $query;
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
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

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('user.email')
            ->add('author')
            ->add('songtitle')
            ->add('video_url')
            ->add('moviecategories')
            // ->add('winner')
            // ->add('onshow')
            // ->add('premiere')
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
            ->add('name')
            ->add('video_url')
            ->add('moviecategories', 'sonata_type_collection', array(
                'by_reference' => false
                ),
                array(
                       'edit' => 'inline',
                       'sortable' => 'position',
                        'inline' => 'table',
                  )
            )
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
            ->add('song_publish_date', 'text')
            ->add('video_publish_date','text')
            ->add('technology')
            ->add('budget_category')
            ->add('description')
            ->add('email')
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

    protected $perPageOptions = array(1000, 200, 50);
    
    protected $maxPerPage = 1000;




}
