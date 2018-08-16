function parsePos(obj) {
    var position = [0,0];                
    try{
        position = JSON.parse(obj).position;
    }catch(e){console.error('Cant prse value ',obj)}
    
    if(typeof(position) == "object" && position.length == 2)
        return position;

    return [0,0];
}

function YaMapsGetLayoutMap(ymaps) {

    var BalloonLayout = ymaps.templateLayoutFactory.createClass(
    '<div class="ya-popover top">' +
        '<a class="close" href="#">&times;</a>' +
        '<div class="arrow"></div>' +
        '<div class="ya-popover-inner">' +
        '$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]' +
        '</div>' +
        '</div>', {

        build: function () {
            this.constructor.superclass.build.call(this);
            this._$element = $('.ya-popover', this.getParentElement());
            this.applyElementOffset();
            this._$element.find('.close')
                .on('click', $.proxy(this.onCloseClick, this));
        },
        clear: function () {
            this._$element.find('.close')
                .off('click');

            this.constructor.superclass.clear.call(this);
        },
        onSublayoutSizeChange: function () {
            BalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

            if(!this._isElement(this._$element)) {
                return;
            }

            this.applyElementOffset();

            this.events.fire('shapechange');
        },
        applyElementOffset: function () {
            this._$element.css({
                left: -(this._$element[0].offsetWidth / 2),
                top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
            });
        },
        onCloseClick: function (e) {
            e.preventDefault();

            this.events.fire('userclose');
        },
        getShape: function () {
            if(!this._isElement(this._$element)) {
                return BalloonLayout.superclass.getShape.call(this);
            }

            var position = this._$element.position();

            return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                [position.left, position.top], [
                    position.left + this._$element[0].offsetWidth,
                    position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
                ]
            ]));
        },
        _isElement: function (element) {
            return element && element[0] && element.find('.arrow')[0];
        }
    }),
    BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<h3 class="ya-popover-title">$[properties.balloonHeader]</h3>' +
        '<div class="ya-popover-content">$[properties.balloonContent]</div>'
    );

    return {BalloonLayout: BalloonLayout, BalloonContentLayout: BalloonContentLayout};
}
