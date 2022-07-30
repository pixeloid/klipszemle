<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class BudgetCategoryAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $filter
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $filter):void
    {
        $filter
            ->add('id')
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $list):void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $form):void
    {
        $form
            ->add('name')
        ;
    }

    protected function configureShowFields(ShowMapper $show):void
    {
        $show
            ->add('id')
            ->add('name')
        ;
    }

}
