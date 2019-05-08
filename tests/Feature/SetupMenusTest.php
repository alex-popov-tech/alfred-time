<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Time\Workflow;

class SetupMenusTest extends TestCase
{
    /** @test */
    public function it_proposes_to_setup_the_workflow_at_first_menu_if_no_timer_services_enabled()
    {
        $output = $this->reachWorkflowInitialMenu();

        $this->assertStringContainsString('"arg":"setup"', $output);
    }

    /** @test */
    public function it_does_not_propose_to_setup_the_workflow_at_first_menu_if_a_timer_service_is_enabled_and_there_is_user_input()
    {
        Workflow::enableService('toggl');

        $output = $this->reachWorkflowInitialMenu([], 'some typing made by the user');

        $this->assertStringNotContainsString('"arg":"setup"', $output);
    }

    /** @test */
    public function it_proposes_to_setup_toggl_and_harvest_if_setup_is_accepted_and_offers_a_go_back_option()
    {
        $output = $this->reachWorkflowSetupMenu();

        $this->assertStringContainsString('"toggl_setup"', $output);
        $this->assertStringContainsString('"harvest_setup"', $output);
    }

    /** @test */
    public function it_proposes_to_enter_toggl_options_if_toggl_setup_is_chosen_and_offers_a_go_back_option()
    {
        $output = $this->reachTogglSetupMenu();

        $this->assertStringContainsString('toggl_setup_apikey"', $output);
        $this->assertStringContainsString('toggl_setup_state"', $output);
        $this->assertStringContainsString('"setup"', $output);
    }

    /** @test */
    public function it_proposes_to_save_toggl_api_key_if_setup_toggl_apikey_is_chosen_and_offers_a_go_back_options()
    {
        $output = $this->reachTogglApikeySetupMenu();

        $this->assertStringContainsString('toggl_setup_apikey_save"', $output);
        $this->assertStringContainsString('toggl_setup"', $output);
    }

    /** @test */
    public function it_proposes_a_go_back_option_if_toggl_api_key_is_saved()
    {
        $output = $this->reachTogglApikeySavedMenu();

        $this->assertStringContainsString('toggl_setup"', $output);
    }

    /** @test */
    public function it_proposes_a_go_back_option_if_toggl_state_is_saved()
    {
        $output = $this->reachTogglStateSavedMenu();

        $this->assertStringContainsString('toggl_setup"', $output);
    }
}
