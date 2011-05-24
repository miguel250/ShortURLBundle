<?php

/*
 * This file is part of the MLPZ\ShortURLBundle
 *
 * (c) Miguel Perez <miguel@mlpz.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MLPZ\ShortURLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints;
use MLPZ\ShortURLBundle\Entity\ShortURL;

/**
 * Main controller
 *
 * @author Miguel Perez <miguel@mlpz.com>
 */
class MainController extends Controller
{

    public function indexAction()
    {

        $request = $this->get('request')->get('url');

        if (!empty($request)) {
            /**
             * @todo find a way to use symfony to validate url
             */
            if (!filter_var($request, FILTER_VALIDATE_URL)) {

                $response = new Response();
                $response->setContent('Invalid Url');
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'text/plain');

                return $response;
            } else {
                $shorturl = new ShortURL();
                $em = $this->get('doctrine')->getEntityManager();
                $longurl = $em->find('MLPZ\ShortURLBundle\Entity\ShortURL', $request);

                if (empty($longurl)) {
                    $shorturl->setLongURL($request);
                    $shorturl->setHash();
                    $shorturl->setCreatedAt();

                    $em->persist($shorturl);
                    $em->flush();
                    $hash = $shorturl->getHash();
                } else {
                    $hash = $longurl->getHash();
                }

                $tinyurl = $this->generateUrl('_redirect', array('hash' => $hash), true);
                $response = new Response();
                $response->setContent($tinyurl);
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'text/plain');

                return $response;
            }
        } else {
            return $this->render('MLPZShortURLBundle:Main:index.html.twig');
        }
    }

    public function redirectAction($hash)
    {

        $shorturl = new ShortURL();
        $em = $this->get('doctrine')->getEntityManager();
        $data = $em->getRepository('MLPZ\ShortURLBundle\Entity\ShortURL')->findOneBy(array('hash' => $hash));

        if (!empty($data)) {
            $longurl = $data->getLongURL();

            $redirect = new RedirectResponse($longurl, 301);
            return $redirect;
        } else {
            return $this->render('MLPZShortURLBundle:Main:notfound.html.twig');
        }
    }

}