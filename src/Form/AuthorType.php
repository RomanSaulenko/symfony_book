<?php


namespace App\Form;


use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AuthorType extends AbstractType
{

    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var UrlGeneratorInterface
     */
    protected $generator;

    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $generator)
    {
        $this->translator = $translator;
        $this->generator = $generator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translator->trans('Fullname')
            ])
            ->add('save', SubmitType::class, ['label' => $this->translator->trans('Save')])
            ->setAction($this->generator->generate('author_store'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}