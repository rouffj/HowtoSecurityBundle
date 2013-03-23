<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class Case1Controller extends Controller
{
    /**
     * @Route("/case1", name="case1")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/case1/member", name="case1_member_index")
     * @Template()
     */
    public function memberAction()
    {
        return array();
    }

    /**
     * @Route("/case1/admin", name="case1_admin_index")
     * @Template()
     */
    public function adminAction()
    {
        return array();
    }
}
