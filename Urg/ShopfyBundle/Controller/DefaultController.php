<?php

namespace Urg\ShopfyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Urg\ShopfyBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        $form = $this->createForm(ProductType::class);
        $form->add("create", SubmitType::class, array('label' => "[+] Product",
            'attr' => array('class' => 'btn btn-primary'))
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $call = $this->get('urg_shopify.service.api');
            $call->createProduct($form->getData());

            return $this->redirectToRoute('urg_shopfy_show_upload', array('id' => $call->getResponse()->id));
        }

        return $this->render('UrgShopfyBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

    /**
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function UploadAction(Request $request) {


        $fileBag = $request->files->get('file');
        $pathname = $fileBag->getPathname();

        $file_name = rand(0, 99999);
        $destination = $this->getParameter('image_directory') . DIRECTORY_SEPARATOR;
        $root_destination = $this->getParameter('kernel.root_dir') . "/.." . $destination;
        $extension = "";

        switch ($fileBag->getMimeType()) {
            case "image/jpeg" : $extension = ".jpg";
                break;
            case "image/gif" : $extension = ".gif";
                break;
            case "image/png" : $extension = ".png";
                break;
            case "image/bmo" : $extension = ".bmp";
                break;
        }

        $fs = new Filesystem();

        try {
            $fs->mkdir($root_destination);
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at " . $e->getPath();
        }
        
        move_uploaded_file($pathname, $root_destination . $file_name . $extension);

        $path = $root_destination . $file_name . $extension;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 =  base64_encode($data);

        unlink($root_destination . $file_name . $extension);
            
        return new JsonResponse(array('base64' => $base64  , 'filename' => $file_name . $extension , 'type' => $type ));
    }

    public function ShowAction($id) {

        $call = $this->get('urg_shopify.service.api');
        $call->getProduct($id);
        $product = $call->getResponse();

        return $this->render('UrgShopfyBundle:Default:show.html.twig', array('products' => $product));
    }

}
