<?php

namespace Oro\Bundle\AddressBundle\Form\Type;

use Oro\Bundle\AddressBundle\Form\EventListener\BuildAddressFormListener;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Oro\Bundle\FlexibleEntityBundle\Form\Type\FlexibleType;

class AddressType extends FlexibleType
{
    /**
     * @var \Oro\Bundle\AddressBundle\Form\EventListener\BuildAddressFormListener
     */
    private $eventListener;

    public function __construct(BuildAddressFormListener $eventListener, $flexibleClass, $valueClass)
    {
        $this->eventListener = $eventListener;

        return parent::__construct($flexibleClass, $valueClass);
    }

    /**
     * {@inheritdoc}
     */
    public function addEntityFields(FormBuilderInterface $builder)
    {
        // add default flexible fields
        parent::addEntityFields($builder);

        $builder->addEventSubscriber($this->eventListener);

        $required =  array(
            'required' => true,
        );
        $notRequired =  array(
            'required' => false,
        );

        // address fields
        $builder
            ->add('street', 'text', $required)
            ->add('street2', 'text', $notRequired)
            ->add('city', 'text', $required)
            ->add('postalCode', 'text', $required)
            ->add('country', 'oro_country', $required)
            ->add('state', 'oro_region', $required)
            ->add('mark', 'text', $notRequired);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'           => $this->flexibleClass,
                'intention'            => 'address',
                'extra_fields_message' => 'This form should not contain extra fields: "{{ extra_fields }}"',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'oro_address';
    }
}
