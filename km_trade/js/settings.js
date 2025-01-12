const { render, useState, useEffect } = wp.element;
const { TextControl, Panel, PanelBody, Button } = wp.components;

function SettingsPage() {
  const [settings, setSettings] = useState({
    address: "",
    workHours: "",
    phone: "",
  });
  const [isSaving, setIsSaving] = useState(false);

  useEffect(() => {
    // Загрузка настроек при монтировании компонента
    Promise.all([
      wp.api.loadPromise.then(() => {
        return wp.api.models.Settings.fetch();
      }),
    ]).then((response) => {
      setSettings({
        address: response[0].km_trade_contact_address,
        workHours: response[0].km_trade_work_hours,
        phone: response[0].km_trade_phone,
      });
    });
  }, []);

  const saveSettings = () => {
    setIsSaving(true);
    const model = new wp.api.models.Settings({
      km_trade_contact_address: settings.address,
      km_trade_work_hours: settings.workHours,
      km_trade_phone: settings.phone,
    });

    model.save().then(() => {
      setIsSaving(false);
    });
  };

  return (
    <div className="wrap">
      <h1>Глобальные настройки сайта</h1>
      <Panel>
        <PanelBody title="Контактная информация" initialOpen={true}>
          <TextControl
            label="Адрес"
            value={settings.address}
            onChange={(value) => setSettings({ ...settings, address: value })}
          />
          <TextControl
            label="Время работы"
            value={settings.workHours}
            onChange={(value) => setSettings({ ...settings, workHours: value })}
          />
          <TextControl
            label="Телефон"
            value={settings.phone}
            onChange={(value) => setSettings({ ...settings, phone: value })}
          />
          <Button isPrimary onClick={saveSettings} isBusy={isSaving}>
            Сохранить
          </Button>
        </PanelBody>
      </Panel>
    </div>
  );
}

render(<SettingsPage />, document.getElementById("km-trade-settings"));
