<?php
class ControllerExtensionModuleHelloworld extends Controller
{
      
         private $error = array();// This is used to set the errors, if any.
 
         public function index() {   // Default function 
             
             
    $this->language->load('extension/module/helloworld'); // Loading the language file of helloworld 
    
    $this->document->setTitle($this->language->get('heading_title')); // Set the title of the page to the heading title in the Language file i.e., Hello World
    //$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
    $this->load->model('setting/module'); // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
 
    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) { // Start If: Validates and check if data is coming by save (POST) method
        if (!isset($this->request->get['module_id'])) {
                $this->model_setting_module->addModule('helloworld', $this->request->post); // Parse all the coming data to Setting Model to save it in database.
            } else {
                $this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
            }
        
                      $this->session->data['success'] = $this->language->get('text_success'); // To display the success text on data save

                  $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module'));

     } // End If
     
      /*This Block returns the warning if any */
     if (isset($this->error['warning'])) {
        $data['error_warning'] = $this->error['warning'];
    } else {
        $data['error_warning'] = '';
    }
   /* End Block*/
 
    /*This Block returns the error code if any */
    if (isset($this->error['code'])) {
        $data['error_code'] = $this->error['code'];
    } else {
        $data['error_code'] = '';
    }
    /*End Block*/
    
    /* Making of Breadcrumbs to be displayed on site*/
    $data['breadcrumbs'] = array();
 
    $data['breadcrumbs'][] = array(
        'text'      => $this->language->get('text_home'),
        'href'      => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token']),
    );
    
     $data['breadcrumbs'][] = array(
        'text'      => $this->language->get('text_extension'),
        'href'      => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module'),
     //   'separator' => ' :: '
    );
     
    //extension/module/helloworld
    /* End Breadcrumb Block*/
   
    // URL to be directed when the save button is pressed 
     
    if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/helloworld', 'user_token=' . $this->session->data['user_token'])
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/helloworld', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'])
            );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('extension/module/helloworld', 'user_token=' . $this->session->data['user_token']);
        } else {
            $data['action'] = $this->url->link('extension/module/helloworld', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id']);
        }

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');

        if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
        }

    
                if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['module_description'])) {
            $data['module_description'] = $this->request->post['module_description'];
        } elseif (!empty($module_info)) {
            $data['module_description'] = $module_info['module_description'];
        } else {
            $data['module_description'] = array();
        }
                
        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        
           
                
           
     $this->response->setOutput($this->load->view('extension/module/helloworld', $data));
  
    
    
}

/* Function that validates the data when Save Button is pressed */
    protected function validate() {
 
        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'extension/module/helloworld')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        /* End Block*/
 
        /* Block to check if the helloworld_text_field is properly set to save into database, otherwise the error is returned*/
        if (!$this->request->post['helloworld_text_field']) {
            $this->error['code'] = $this->language->get('error_code');
        }
        /* End Block*/
 
        /*Block returns true if no error is found, else false if any error detected*/
        if (!$this->error) {
            return true;
        } else {
            return false;
        }   
        /* End Block*/
    }
    /* End Validation Function*/
    

 

//change

/* Function that validates the data when Save Button is pressed */
    protected function validate2() {
 
        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'extension/module/helloworld')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        /* End Block*/
 
        /* Block to check if the helloworld_text_field is properly set to save into database, otherwise the error is returned*/
       // if (!$this->request->post['helloworld_text_field']) {
      //      $this->error['code'] = $this->language->get('error_code');
      //  }
        /* End Block*/
        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }
        return !$this->error;
        /*Block returns true if no error is found, else false if any error detected*/
      //  if (!$this->error) {
      //      return true;
      //  } else {
      //      return false;
      //  }   
        /* End Block*/
    }
    /* End Validation Function*/  
    
}