<?php

namespace App\Controller\Admin;
use App\Form\VirtualMachineType;
use App\Service\VmwareWorkstationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MonitorController extends AbstractController
{
    private $VmwareWorkstationService;
    private $urlGenerator;

    public function __construct(VmwareWorkstationService $VmwareWorkstationService,UrlGeneratorInterface $urlGenerator)
    {
        $this->VmwareWorkstationService = $VmwareWorkstationService;
        $this->urlGenerator = $urlGenerator;
    }


        #[Route('/monitor', name: 'monitor')]
        public function index(VmwareWorkstationService $vmwareService): Response
        {
            // Fetch virtual machine data from the service
            $virtualMachines = $vmwareService->getVirtualMachines();

            // Render a template with the virtual machine data
            return $this->render('/admin/index.html.twig', [
                'virtualMachines' => $virtualMachines,
                'urlGenerator' => $this->urlGenerator,
            ]);
        }
    #[Route('/monitor/{id}', name: 'id')]
    public function getByid(VmwareWorkstationService $vmService,string $id): Response
    {
        // Fetch virtual machine data from the service
        $vmDetails = $vmService->getVirtualMachineById($id);

        // Render a template with the virtual machine data
        return $this->render('/admin/vmdetails.html.twig', [
            'virtualMachinesDetails' => $vmDetails,
        ]);
    }
    #[Route('/monitor/restrictions/{id}', name: 'restrictions')]
    public function getRestriction(VmwareWorkstationService $vmService,string $id): Response
    {
        // Fetch virtual machine data from the service
        $vmRes = $vmService->getRestriction($id);

        // Render a template with the virtual machine data
        return $this->render('/admin/restriction.html.twig', [
            'virtualMachinesRes' => $vmRes,
        ]);
    }
    #[Route('/monitor/{id}/ip', name: 'ip')]
    public function getIp(VmwareWorkstationService $vmService,string $id): Response
    {
        // Fetch virtual machine data from the service
        $vmRes = $vmService->getIp($id);

        // Render a template with the virtual machine data
        return $this->render('/admin/ip.html.twig', [
            'virtualMachinesIp' => $vmRes,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]

    #[Route('/update_vm/{id}', name: 'update_vm')]
    public function updateVm(Request $request, $id): Response
    {
        $form = $this->createForm(VirtualMachineType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // $id = $request->attributes->get('id'); // You don't need this line here

            // Call the service to update the virtual machine
            $result = $this->VmwareWorkstationService->updateVirtualMachine(
                $id,
                $data['processors'],
                $data['memory']
            );

            if (isset($result['error'])) {
                return new Response('Erreur lors de la mise à jour de la machine virtuelle: ' . $result['error'],
                    Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return new Response('Mise à jour de la machine virtuelle réussie', Response::HTTP_OK);
        }

        return $this->render('admin/update_vm.html.twig', [
            'form' => $form->createView(),
            'urlGenerator' => $this->urlGenerator,
        ]);
    }
}
