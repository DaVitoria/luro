<?php

try {
  test('__invoke', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
} catch (Exception $e) {
  return $e;
}


try {
  test('redirectToGithub', function () {
    $response = $this->get('github');

    $response->assertStatus(200);
  });
} catch (Exception $e) {
  return $e;
}


