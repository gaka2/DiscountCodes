<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\GenerateCodesFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;
use App\Service\DiscountCodesService;
use App\Serializer\DiscountCodeSerializerInterface;

/**
 * @author Karol Gancarczyk
 */
class DiscountCodesController extends AbstractController {

    /**
     * @Route("/codes/generate", name="generate_discount_codes")
     */
    public function generateCodes(Request $request, DiscountCodesService $discountCodesService, DiscountCodeSerializerInterface $discountCodeSerializer) {

        $form = $this->createForm(GenerateCodesFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $numberOfCodes = $formData['numberOfCodes'];
            $lengthOfCode = $formData['lengthOfCode'];

            $discountCodes = $discountCodesService->generateDiscountCodes($numberOfCodes, $lengthOfCode);
            $fileContent = $discountCodeSerializer->serializeObjects($discountCodes);

            $response = new Response($fileContent);
            $disposition = HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                $formData['fileName']
            );
            $response->headers->set('Content-Disposition', $disposition);
            return $response;
        }

        return $this->render('discount_codes/generate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}