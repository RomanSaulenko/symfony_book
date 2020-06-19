<?php


namespace App\EventSubscriber;

use App\Event\Book\BeforeAddImage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class BookSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            BeforeAddImage::class => [
                ['deleteOldImageFromFilesystem', 0],
            ],
        ];
    }

    public function deleteOldImageFromFilesystem(BeforeAddImage $event)
    {
        $book = $event->getBook();
        $imageName = $book->getImage();
        $imageDirectory = $event->getImageDirectory();

        $fileSystem = new Filesystem();
        $fileSystem->remove($imageDirectory . '/' . $imageName);
    }
}