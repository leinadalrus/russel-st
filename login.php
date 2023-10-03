<aside>
  <section class="login-section">
    <form method="get" action="misc/action.php" class="custom-form-container" onsubmit="processFormData()">
      <input type="email" id="email-field-style" name="email" onchange="validateEmailID()" />
      <input type="password" id="password-field-style" name="password" />

      <button type="submit" id="login-button-style" name="signage" formnovalidate>Sign In</button>
    </form>
  </section>
</aside>

<style>
  .login-section {
    transform: translate(-14.704rem, 0);
    max-width: 15.704rem;
    max-height: fit-content;

    position: relative;
    display: grid;

    padding: 1rem;
    margin-right: 33%;
    margin-left: 42%;
    margin-top: 20%;

    border: 0.063rem solid #ecf1f2;
    border-radius: 1.5rem;
    padding: 2.704rem;
  }

  .custom-form-container {
    display: inline-flex;
    flex-direction: column;

    justify-content: center;
    align-items: center;

    line-height: 1.126rem;
    gap: 0.704rem;
  }

  #email-field-style {
    padding: 1rem;
  }

  #password-field-style {
    padding: 1rem;
  }

  input {
    border-top: none !important;
    border-right: none !important;
    border-left: none !important;
    border-bottom: solid #0af;
  }

  select {
    border-top: none !important;
    border-right: solid #0af;
    border-left: none !important;
    border-bottom: none !important;
  }

  #login-button-style {
    transform: translate(10.704rem, 0);
    background-color: crimson;

    border-top: none !important;
    border-right: none !important;
    border-left: none !important;

    border-bottom: none !important;
    border-bottom-right-radius: 0.5rem;
    border-bottom-left-radius: 0.2rem;

    width: 17.256rem;
    height: 2.6rem;
    max-height: 2.2rem;

    padding-bottom: 1.15%;
    padding: 0.3rem;
    margin: 0.1rem;
    position: relative;

    text-align: justify;
    text-align-last: end;

    opacity: 80%;
    color: white;
  }

  input:invalid {
    border-bottom: 0.1rem dashed crimson;
  }
</style>