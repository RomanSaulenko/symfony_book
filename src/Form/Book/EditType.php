<?php


namespace App\Form\Book;


use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Contracts\Translation\TranslatorTrait;

class EditType extends AbstractType
{
    use TranslatorTrait;

    /**
     * @var UrlGeneratorInterface
     */
    protected $generator;

    public function __construct(UrlGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('isbn', TextType::class)
            ->add('year_created', NumberType::class)
            ->add('page_count', NumberType::class)
            ->add('authors', null, [
                    'choice_label' => 'name',
                ]
            )
            ->add('image_file', FileType::class, [
                'mapped' => false,
                'required' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => $this->trans('book.image_invalid_format'),
                    ])
                ],
            ])
            ->add('image', HiddenType::class)
            ->add('save', SubmitType::class)
            ->setMethod('PUT')
            ->setAction($this->generator->generate('book_edit', ['id' => $options['data']->getId()]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}