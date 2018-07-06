<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DocuSign\eSign\Configuration as Configuration;
use Aura\Filter\FilterFactory;

class mainController
{

    public $connection_object = "";
    private $loginAccount = "";
    private $loginInformation = "";

    public function __construct($formData)
    {
        define('USERNAME', '213ba94b-cb7a-4bd8-a11e-6cfbd3b0071d');
        define('PASSWORD', 'pingpong');
        define('KEY', '27616b49-0905-4fb9-aba4-383eef6ba1a7');
        define('HOST', 'https://demo.docusign.net/restapi');
        $this->init();
    }

    /**
     * Function to prepare connection through the SDK
     * Singleton design pattern was implemented here to avoid too much to-fro
     */

    public function init()
    {

        $con = $this->connection_object;
        If ($con == "")
            try {
                // create configuration object and configure custom auth header
                $config = new Configuration();

                // create configuration object and configure custom auth header
                $config = new DocuSign\eSign\Configuration();
                $config->setHost(HOST);
                $config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . USERNAME . "\",\"Password\":\"" . PASSWORD . "\",\"IntegratorKey\":\"" . KEY . "\"}");

                // instantiate a new docusign api client
                $apiClient = new DocuSign\eSign\ApiClient($config);
                $accountId = null;

                $authenticationApi = new DocuSign\eSign\Api\AuthenticationApi($apiClient);
                $options = new DocuSign\eSign\Api\AuthenticationApi\LoginOptions();
                $loginInformation = $authenticationApi->login($options);


                if (isset($loginInformation) && count($loginInformation) > 0) {
                    $loginAccount = $loginInformation->getLoginAccounts()[0];
                    $this->loginInformation = $loginInformation;
                    $this->loginAccount = $loginAccount;
                    $host = $loginAccount->getBaseUrl();
                    $host = explode("/v2", $host);
                    $host = $host[0];
                    // UPDATE configuration object
                    $config->setHost($host);

                    // instantiate a NEW docusign api client (that has the correct baseUrl/host)
                    $apiClient = new DocuSign\eSign\ApiClient($config);

                    $this->connection_object = $apiClient;
                }
            } catch (\Exception $e) {
                echo "Could not connect";
            }

    }

    /**
     * @param $formData
     * @return string :: templateId if successful OR
     * @throws exception if not successful
     * Though not in the question but I thought why not given the fact that I have extra time
     */
    public function createTemplate($formData)
    {
        $this->formInputSanitation($formData);
        try {
            $apiClient = $this->connection_object;
            $loginAccount = $this->loginAccount;
            if (isset($this->loginInformation)) {
                $accountId = $loginAccount->getAccountId();
                if (!empty($accountId)) {

                    $documentFileName = 'http://testshinehub.herokuapp.com/Docs/SignTest1.pdf';

                    $templateApi = new DocuSign\eSign\Api\TemplatesApi($apiClient);

                    $envelope_template_definition = new DocuSign\eSign\Model\EnvelopeTemplateDefinition();
                    $envelope_template_definition->setName('Document Ginger Ale');
                    $envelope_template_definition->setDescription('This is a test Template');

                    $envelope_document = new DocuSign\eSign\Model\Document();
                    $envelope_document->setUri('http://testshinehub.herokuapp.com/Docs/SignTest1.pdf');
                    $envelope_document->setName('SignTest1.docx');
                    $envelope_document->setDocumentId(1);
                    $envelope_document->setFileExtension('pdf');
                    $envelope_document->setDocumentBase64(base64_encode(file_get_contents($documentFileName)));


                    $tab = new DocuSign\eSign\Model\Tabs();

                    $signers = new DocuSign\eSign\Model\Signer();
                    $signers->setName('Jon Doe');
                    $signers->setRecipientId(1);
                    $signers->setEmail('aerodott@gmail.com');
                    $signers->setTabs($tab);
                    $signers->setClientUserId('1');

                    $envelope_recipient = new DocuSign\eSign\Model\Recipients();
                    $envelope_recipient->setSigners([$signers]);

                    $envelope_definition = new DocuSign\eSign\Model\EnvelopeTemplate();
                    $envelope_definition->setEmailSubject('Please Sign this');
                    $envelope_definition->setEmailBlurb('Hey, I think I be body');
                    $envelope_definition->setStatus('sent');
                    $envelope_definition->setDocuments([$envelope_document]);
                    $envelope_definition->setEnvelopeTemplateDefinition($envelope_template_definition);
                    $envelope_definition->setRecipients($envelope_recipient);


                    $envelop_summary = $templateApi->createTemplate($accountId, $envelope_definition);
                    if (!empty($envelop_summary)) {
                        return $envelop_summary->getTemplateId();
                    }


                }

            }

        } catch (\Exception $e) {
            echo 'Sorry, we encountered an error: ' . $e->getMessage();
        }

    }


    /**
     * @param $formData
     * @return URL as asked in the question OR
     * @throws Exception if not successful
     *
     * Please The URL could have been instantly redirected on the main page but I felt that it
     * needs to be shown since it was ex[licitly asked in the question
     *
     * Some few dynamic data were passed and Tabs injected too as asked in the question.
     */
    public function createEnvelope($formData)
    {
        $this->formInputSanitation($formData);
        try {
            $apiClient = $this->connection_object;
            $loginAccount = $this->loginAccount;

            if (isset($this->loginInformation)) {
                $accountId = $loginAccount->getAccountId();
                if (!empty($accountId)) {
                    $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($apiClient);


                    $signHere = new \DocuSign\eSign\Model\SignHere();
                    $signHere->setXPosition("300");
                    $signHere->setYPosition("600");
                    $signHere->setDocumentId("1");
                    $signHere->setPageNumber("1");
                    $signHere->setRecipientId("1");
                    $signHere->setTabLabel('Append Signature here');

                    $signFullname = new DocuSign\eSign\Model\FullName();
                    $signFullname->setName('Name');
                    $signFullname->setDocumentId('1');
                    $signFullname->setRecipientId('1');
                    $signFullname->setPageNumber('1');
                    $signFullname->setTabLabel('Name');
                    $signFullname->setXPosition("100");
                    $signFullname->setYPosition("300");

                    $signTextTabEmail = new DocuSign\eSign\Model\Text();
                    $signTextTabEmail->setName('Email');
                    $signTextTabEmail->setValue($formData['email']);
                    $signTextTabEmail->setTabLabel('Email');
                    //$signTextTabEmail->setLocked('');
                    $signTextTabEmail->setDocumentId('1');
                    $signTextTabEmail->setRecipientId('1');
                    $signTextTabEmail->setPageNumber('1');
                    $signTextTabEmail->setXPosition("400");
                    $signTextTabEmail->setYPosition("300");


                    $tab = new DocuSign\eSign\Model\Tabs();
                    $tab->setSignHereTabs([$signHere]);
                    $tab->setFullNameTabs([$signFullname]);
                    $tab->setTextTabs([$signTextTabEmail]);

                    $templateRole = new  DocuSign\eSign\Model\TemplateRole();
                    $templateRole->setEmail($formData['email']);
                    $templateRole->setName($formData['name']);
                    $templateRole->setRoleName("Worker");
                    $templateRole->setClientUserId($accountId); //to be disabled for non-embedded
                    $templateRole->setTabs($tab);
                    $templateRole->setEmbeddedRecipientStartUrl('SIGN_AT_DOCUSIGN');

                    // instantiate a new envelope object and configure settings
                    $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
                    $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Signature Request Sample");
                    $envelop_definition->setTemplateId("e9770ffb-e5ec-42ec-9d3e-66ec433b42a1");
                    $envelop_definition->setTemplateRoles(array($templateRole));

                    // set envelope status to "sent" to immediately send the signature request
                    $envelop_definition->setStatus("sent");

                    // optional envelope parameters
                    $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
                    $options->setCdseMode(null);
                    $options->setMergeRolesOnDraft(null);

                    // create and send the envelope (aka signature request)
                    $envelop_summary = $envelopeApi->createEnvelope($accountId, $envelop_definition, $options);

                    $recipView = new DocuSign\eSign\Model\RecipientViewRequest();
                    $recipView->setClientUserId($accountId);
                    $recipView->setRecipientId('1');
                    $recipView->setEmail($formData['email']);
                    $recipView->setUserName($formData['name']);
                    $recipView->setAuthenticationMethod('email');
                    $recipView->setReturnUrl('https://shinehub.com.au/');

                    $senderView = $envelopeApi->createRecipientView($accountId, $envelop_summary->getEnvelopeId(),$recipView);

                    if (!empty($senderView)) {
                        return $senderView->getUrl();

                    }
                }

            }
        } catch (DocuSign\eSign\ApiException $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
        }

    }

    public function generateTemplateSend()
    {
        //This function will generate template instantly/dynamically and also send it by calling the two methods above but as it is not in the question, I will just let it be.

    }

    /**
     * @param $formData
     * Input sanitation function from the UI.
     */

    public function formInputSanitation($formData)
    {
        $filter_factory = new FilterFactory();

        $filter = $filter_factory->newValueFilter();

        $username = $formData['email'];

        $ok =$filter->validate($username, 'strlenBetween', 3, 30);

        if (! $ok) {
            echo "The username is not valid.";
        }

        $filter = $filter_factory->newSubjectFilter();

       $filter->validate($formData['email'])->isNotBlank();

    }

    //Thanks very much, Sir.


}


