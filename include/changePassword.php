<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="updatePassword.php" method="post">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm text-end" for="oldPassword">Vecchia
                            Password:</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="password" id="oldPassword" name="oldPassword" required>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm text-end" for="password">Nuova
                            Password:</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm text-end"
                            for="confirm_password">Conferma Nuova Password:</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password"
                                required>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <input class="btn btn-primary" type="submit" value="Aggiorna Password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>