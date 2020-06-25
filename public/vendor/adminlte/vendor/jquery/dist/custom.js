jQuery(document).ready(function ($) {
    /* =========== MASK FIELDS + VALIDATION ======== */
    /* == PHONE MASK == */
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.telefone').mask(SPMaskBehavior, spOptions);


    // == CPF AND CNPJ MASK ==
    var CpfCnpjMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
    },
        cpfCnpjpOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.cpf_cnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
    /* === END MASK FIELDS === */
});