// More information on https://github.com/Ionaru/easy-markdown-editor

import _ from 'lodash';

const triggerEditorElementsDetection = () => {
    const editorElements = document.querySelectorAll('textarea[data-editor]');
    if (editorElements.length) {
        const EasyMde = require('easymde');
        _.each(editorElements, (key, editor) => {
            const easyMde = new EasyMde({
                element: editor,
                forceSync: true,
                spellChecker: false,
                hideIcons: ['image'],
                showIcons: ['table'],
                status: [
                    'lines',
                    'words',
                    {
                        className: 'characters',
                        defaultValue: (el) => {
                            el.innerHTML = '0';
                        },
                        onUpdate: (el) => {
                            el.innerHTML = easyMde.value().length.toString();
                        }
                    }
                ]
            });
        });
    }
};

triggerEditorElementsDetection();
