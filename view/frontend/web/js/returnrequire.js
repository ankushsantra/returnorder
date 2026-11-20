define(
    [
        'jquery',
        'underscore',
        'mage/template'
        ], function ($, _, template) {
            function main(config, element)
            {
                var $element = $(element);
                var ajaxUrl = config.ajaxUrl;
                $(document).on(
                    'change','#selectOrder',function () {
                        var orderIncrementId = $('#selectOrder').children("option:selected").val();
                        var param = 'orderIncrementId='+orderIncrementId;
                            $.ajax(
                                {
                                    showLoader: true,
                                    url: ajaxUrl,
                                    data: param,
                                    type: "POST",
                                    dataType: 'json'
                                }
                            ).done(
                                function (data) {
                                    var selectProduct = $('#selectProduct');
                                    selectProduct.empty().append(data);
                                }
                            );
                    }
                );
            };
            return main;
        }
);