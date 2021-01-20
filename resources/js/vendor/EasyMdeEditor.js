// More information on https://github.com/Ionaru/easy-markdown-editor

import EasyMDE from 'easymde';
import _ from 'lodash';

export default class EasyMdeEditor {

    static init() {
        _.each(document.querySelectorAll('textarea[data-editor]'), (element) => {
            const easyMde = new EasyMDE({
                element,
                forceSync: true,
                spellChecker: false,
                hideIcons: ['image'],
                showIcons: ['table'],
                status: [
                    'lines',
                    'words',
                    {
                        className: 'characters',
                        defaultValue: (el) => {el.innerHTML = '0';},
                        onUpdate: (el) => {el.innerHTML = easyMde.value().length.toString();}
                    }
                ]
            });
        });
    }

}
