<?php declare(strict_types=1);

namespace ExampleExtendContactFormEvent\Core;

use Shopware\Core\Content\ContactForm\ContactFormService as DecoratedService;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Validation\DataBag\DataBag;
use Shopware\Core\Framework\Validation\DataValidator;
use Shopware\Core\Framework\Validation\ValidationServiceInterface;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ContactFormService extends DecoratedService
{
    /**
     * @var DecoratedService
     */
    private $contactFormService;

    /**
     * @var EntityRepositoryInterface
     */
    private $customRepository;

    public function __construct(
        DecoratedService $contactFormService,
        EntityRepositoryInterface $customRepository,
        ValidationServiceInterface $contactFormValidationService,
        DataValidator $validator,
        EventDispatcherInterface $eventDispatcher,
        SystemConfigService $systemConfigService
    ) {
        $this->contactFormService = $contactFormService;
        $this->customRepository = $customRepository;

        parent::__construct($contactFormValidationService, $validator, $eventDispatcher, $systemConfigService);
    }

    public function sendContactForm(DataBag $data, SalesChannelContext $context): void
    {
        $customEntities = $this->customRepository->search((new Criteria())->setLimit(1), $context->getContext());
        $data->add(['myEntity' => $customEntities->first()]);

        $this->contactFormService->sendContactForm($data, $context);
    }
}
