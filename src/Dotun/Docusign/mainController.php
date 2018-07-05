<?php


require_once __DIR__ . '/../../../vendor/autoload.php';

use DocuSign\eSign\Configuration as Configuration;

class mainController
{

    private $connection_object = "";
    private $loginAccount = "";
    private $loginInformation = "";

    public function __construct($formData){

        define('USERNAME', '213ba94b-cb7a-4bd8-a11e-6cfbd3b0071d');
        define('PASSWORD', 'pingpong');
        define('KEY', '27616b49-0905-4fb9-aba4-383eef6ba1a7');
        define('HOST', 'https://demo.docusign.net/restapi');
            $this->init();
    }


    public function init(){

        $con = $this->connection_object ;
        If( $con == "" )
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
        }
            catch(\Exception $e){
                echo "Could not connect";
            }

    }

    public function createTemplate(){

       try{
           $apiClient = $this->connection_object;
           $loginAccount = $this->loginAccount;
                if(isset($this->loginInformation))
                {
                    $accountId = $loginAccount->getAccountId();
                    if(!empty($accountId))
                    {

                        $documentFileName = 'http://testshinehub.herokuapp.com/Docs/SignTest1.pdf';

                        $templateApi = new DocuSign\eSign\Api\TemplatesApi($apiClient);

                        $envelope_template_definition= new DocuSign\eSign\Model\EnvelopeTemplateDefinition();
                        $envelope_template_definition->setName('Document Ginger Ale');
                        $envelope_template_definition->setDescription('This is a test Template');

                        $envelope_document = new DocuSign\eSign\Model\Document();
                        $envelope_document->setUri('http://testshinehub.herokuapp.com/Docs/SignTest1.pdf');
                        $envelope_document->setName('SignTest1.docx');
                        $envelope_document->setDocumentId(1);
                        $envelope_document->setFileExtension('pdf');
                        $envelope_document->setDocumentBase64(base64_encode(file_get_contents($documentFileName)));

                        $signHeretab = new DocuSign\eSign\Model\SignHere();
                        $signHeretab->setName('Sign Here');
                        $signHeretab->setDocumentId('1');
                        $signHeretab->setRecipientId('1');
                        $signHeretab->setPageNumber('1');
                        $signHeretab->setAnchorString('X');
                        $signHeretab->setAnchorXOffset('100');
                        $signHeretab->setAnchorYOffset('-2');
                        $signHeretab->setTabLabel('Sign Here');

                        $signFullname = new DocuSign\eSign\Model\FullName();
                        $signFullname->setName('Name');
                        $signFullname->setDocumentId('1');
                        $signFullname->setRecipientId('1');
                        $signFullname->setPageNumber('1');
                        $signFullname->setAnchorString('X');
                        $signFullname->setAnchorXOffset('100');
                        $signFullname->setAnchorYOffset('-2');
                        $signFullname->setTabLabel('Name');

                        $signTextTabEmail = new DocuSign\eSign\Model\Text();
                        $signTextTabEmail->setName('Email');
                        $signTextTabEmail->setValue('aerodott@gmail.com');
                        $signTextTabEmail->setTabLabel('Email');
                        $signTextTabEmail->setDocumentId('1');
                        $signTextTabEmail->setRecipientId('1');
                        $signTextTabEmail->setPageNumber('1');
                        $signTextTabEmail->setAnchorString('E-mail');
                        $signTextTabEmail->setAnchorXOffset('100');
                        $signTextTabEmail->setAnchorYOffset('-2');

                        $tab = new DocuSign\eSign\Model\Tabs();
//                        $tab->setSignHereTabs([$signHeretab]);
//                        $tab->setFullNameTabs([$signFullname]);
//                        $tab->setTextTabs([$signTextTabEmail]);

                        $signers = new DocuSign\eSign\Model\Signer();
                        $signers->setName('Jon Doe');
                        $signers->setRecipientId(1);
                        $signers->setEmail('aerodott@gmail.com');
                        $signers->setTabs($tab);
                        $signers->setClientUserId('1');

                        $envelope_recipient= new DocuSign\eSign\Model\Recipients();
                        $envelope_recipient->setSigners([$signers]);

                        $envelope_definition= new DocuSign\eSign\Model\EnvelopeTemplate();
                        $envelope_definition->setEmailSubject('Please Sign this');
                        $envelope_definition->setEmailBlurb('Hey, I think I be body');
                        $envelope_definition->setStatus('sent');
                        $envelope_definition->setDocuments([$envelope_document]);
                        $envelope_definition->setEnvelopeTemplateDefinition($envelope_template_definition);
                        $envelope_definition->setRecipients($envelope_recipient);


                        $envelop_summary = $templateApi->createTemplate($accountId,$envelope_definition);
                        if(!empty($envelop_summary))
                        {
                            echo $envelop_summary;
                        }


                    }

                }

        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function createEnvelope(){
        try
        {
            $apiClient = $this->connection_object;
            $loginAccount = $this->loginAccount;

                if(isset($this->loginInformation))
                {
                    $accountId = $loginAccount->getAccountId();
                    if(!empty($accountId))
                    {
                        $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($apiClient);

//                        $signHeretab = new DocuSign\eSign\Model\SignHere();
//                        $signHeretab->setName('Sign Here');
//                        $signHeretab->setDocumentId('1');
//                        $signHeretab->setRecipientId('1');
//                        $signHeretab->setPageNumber('1');
//                        //$signHeretab->setAnchorString('X');
//                        $signHeretab->setAnchorXOffset('100');
//                        $signHeretab->setAnchorYOffset('-2');
//                        $signHeretab->setTabLabel('Sign Here');

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
//                        $signFullname->setAnchorXOffset('100');
//                        $signFullname->setAnchorYOffset('-2');
//                        $signFullname->setAnchorString("Name");

                        $signTextTabEmail = new DocuSign\eSign\Model\Text();
                        $signTextTabEmail->setName('Email');
                        $signTextTabEmail->setValue('aerodott@gmail.com');
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
                        $templateRole->setEmail("aerodott@gmail.com");
                        $templateRole->setName("Arowolo Dotun");
                        $templateRole->setRoleName("Worker");
                        $templateRole->setClientUserId($accountId); //to be disabled for non-embedded
                        $templateRole->setTabs($tab);
                        $templateRole->setEmbeddedRecipientStartUrl('SIGN_AT_DOCUSIGN');


                        // instantiate a new envelope object and configure settings
                        $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
                        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Signature Request Sample");
                        $envelop_definition->setTemplateId("764fbf0b-d984-4b7c-a3bf-e345e273e76e");
                        $envelop_definition->setTemplateRoles(array($templateRole));

                        // set envelope status to "sent" to immediately send the signature request
                        $envelop_definition->setStatus("sent");

                        // optional envelope parameters
                        $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
                        $options->setCdseMode(null);
                        $options->setMergeRolesOnDraft(null);

                        // create and send the envelope (aka signature request)
                        $envelop_summary = $envelopeApi->createEnvelope($accountId, $envelop_definition, $options);
                        if(!empty($envelop_summary))
                        {
                            echo "$envelop_summary";
                        }
                    }

            }
        }
        catch (DocuSign\eSign\ApiException $ex)
        {
            echo "Exception: " . $ex->getMessage() . "\n";
        }

    }



}


