<?php
// src/Form/VirtualMachineType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VirtualMachineType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('processors', IntegerType::class, [
'label' => 'Processors'
])
->add('memory', IntegerType::class, [
'label' => 'Memory (MB)'
]);
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
'data_class' => null,
]);
}
}
