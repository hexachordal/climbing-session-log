import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit( { attributes, setAttributes } ) {
    const { sessionsToShow } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title="Recent Sessions settings">
                    <RangeControl
                        label="Sessions to show"
                        value={ sessionsToShow }
                        onChange={ ( value ) => setAttributes( { sessionsToShow: value } ) }
                        min={ 1 }
                        max={ 10 }
                    />
                </PanelBody>
            </InspectorControls>
            <div { ...useBlockProps() }>
                <ServerSideRender
                    block="climbing-log/recent-sessions"
                    attributes={ attributes }
                />
            </div>
        </>
    );
}
