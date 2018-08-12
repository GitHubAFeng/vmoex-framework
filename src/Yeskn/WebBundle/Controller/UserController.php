<?php

/*
 * This file is part of project yeskn/vmoex.
 *
 * (c) Jaggle <jaggle@yeskn.com>
 *
 * created at 2018-05-26 01:46:15
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yeskn\WebBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/member/{username}", name="user_home")
     */
    public function userHomeAction($username)
    {
        $user = $this->getDoctrine()->getRepository('YesknWebBundle:User')
            ->findOneBy(['username' => $username]);
        if (!$user) {
            return $this->render('@YesknWeb/error.html.twig', [
                'message' => '用户不存在'
            ]);
        }

        $userActive = $this->getDoctrine()->getRepository('YesknWebBundle:Active')
            ->findOneBy(['user' => $user], ['id' => 'DESC']);

        $online = false;

        if ($userActive and $userActive->getUpdatedAt()->getTimestamp() >= time() - 15*60) {
            $online = true;
        }

        return $this->render('@YesknWeb/user/user_home.html.twig', [
            'user' => $user,
            'online' => $online,
            'userActive' => $userActive
        ]);
    }
}