Feature: Homepage
  In order to test out the basics

  Scenario: Homepage
    Given I am not logged in
    When I visit "/"
    Then the response status code should be 200

  Scenario: Submit connection
    Given I am an anonymous user
    When I visit "/user/login"
    And I fill in "edit-name" with "admin"
    And I fill in "edit-pass" with "test"
    And I press the "Log in" button
    Then I should see "Unrecognized username or password."