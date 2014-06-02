<?php

namespace OroCRM\Bundle\CampaignBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampaignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label'    => 'orocrm.campaign.name.label',
                    'required' => true,
                )
            )
            ->add(
                'code',
                'orocrm_campaign_code_type',
                array(
                    'label'    => 'orocrm.campaign.code.label',
                    'required' => true,
                )
            )
            ->add(
                'startDate',
                'oro_datetime',
                array(
                    'label'    => 'orocrm.campaign.start_date.label',
                    'required' => false,
                )
            )
            ->add(
                'endDate',
                'oro_datetime',
                array(
                    'label'    => 'orocrm.campaign.end_date.label',
                    'required' => false,
                )
            )->add(
                'description',
                'text',
                array(
                    'label'    => 'orocrm.campaign.description.label',
                    'required' => false,
                )
            )
            ->add(
                'budget',
                'oro_money',
                array(
                    'label'    => 'orocrm.campaign.budget.label',
                    'required' => false,
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'OroCRM\Bundle\CampaignBundle\Entity\Campaign',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orocrm_campaign_form';
    }
}
